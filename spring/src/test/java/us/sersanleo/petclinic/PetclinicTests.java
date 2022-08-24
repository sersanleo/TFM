package us.sersanleo.petclinic;

import static org.junit.jupiter.api.Assertions.assertFalse;
import static org.junit.jupiter.api.Assertions.assertTrue;
import static org.springframework.security.test.web.servlet.request.SecurityMockMvcRequestBuilders.formLogin;
import static org.springframework.security.test.web.servlet.request.SecurityMockMvcRequestPostProcessors.csrf;
import static org.springframework.security.test.web.servlet.response.SecurityMockMvcResultMatchers.authenticated;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.post;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.model;

import java.text.SimpleDateFormat;
import java.util.Calendar;

import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.jdbc.AutoConfigureTestDatabase;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.test.context.junit.jupiter.SpringExtension;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.transaction.annotation.Transactional;

import us.sersanleo.petclinic.models.User;
import us.sersanleo.petclinic.repository.UserRepository;

@ExtendWith(SpringExtension.class)
@SpringBootTest
@AutoConfigureMockMvc
@AutoConfigureTestDatabase
@Transactional
class PetclinicTests {
    private static final SimpleDateFormat DATE_FORMATTER = new SimpleDateFormat("yyyy-MM-dd");

    @Autowired
    private MockMvc mockMvc;

    @Autowired
    PasswordEncoder passwordEncoder = null;
    @Autowired
    private UserRepository userRepository;

    @Test
    void registerSuccesfully() throws Exception {
        Calendar date = Calendar.getInstance();
        date.set(2000, 0, 1);
        String email = "test@test.com";

        mockMvc.perform(post("/register")
                .param("email", email)
                .param("password", "Test1234")
                .param("passwordConfirmation", "Test1234")
                .param("firstName", "Test")
                .param("lastName", "Test")
                .param("address", "Test")
                .param("birthday", DATE_FORMATTER.format(date.getTime()))
                .with(csrf()));

        assertTrue(userRepository.findByEmail(email).isPresent());
    }

    @Test
    void registerError() throws Exception {
        Calendar date = Calendar.getInstance();
        date.set(2000, 0, 1);
        String email = "test@test.com";

        mockMvc.perform(post("/register")
                .param("email", email)
                .param("password", "Test1234")
                .param("passwordConfirmation", "Test1234error")
                .param("firstName", "Test")
                .param("lastName", "Test")
                .param("address", "Test")
                .param("birthday", DATE_FORMATTER.format(date.getTime()))
                .with(csrf()))
                .andExpect(model().attributeHasFieldErrors("user", "passwordConfirmation"));

        assertFalse(userRepository.findByEmail(email).isPresent());
    }

    @Test
    void loginSuccessfully() throws Exception {
        Calendar birthday = Calendar.getInstance();
        birthday.set(2000, 0, 1);
        String password = "vet1";
        User vet = userRepository.save(
                new User("vet1@petclinic.com", passwordEncoder.encode(password), "Test vet1", "Test", "Test address",
                        birthday.getTime(), true));

        mockMvc.perform(formLogin()
                .user(vet.getEmail())
                .password(password))
                .andExpect(authenticated().withUsername(vet.getEmail()));
    }
}