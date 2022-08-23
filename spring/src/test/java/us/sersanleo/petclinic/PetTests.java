package us.sersanleo.petclinic;

import static org.junit.jupiter.api.Assertions.assertFalse;
import static org.junit.jupiter.api.Assertions.assertTrue;
import static org.springframework.security.test.web.servlet.request.SecurityMockMvcRequestPostProcessors.csrf;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.post;

import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.security.test.context.support.WithUserDetails;
import org.springframework.test.context.junit.jupiter.SpringExtension;
import org.springframework.test.web.servlet.MockMvc;

import us.sersanleo.petclinic.models.Pet;
import us.sersanleo.petclinic.repository.PetRepository;

@ExtendWith(SpringExtension.class)
@SpringBootTest
@AutoConfigureMockMvc
class PetTests {
    @Autowired
    private MockMvc mockMvc;
    @Autowired
    private PetRepository petRepository;

    @Test
    @WithUserDetails("vet1@petclinic.com")
    void deleteSuccessfully() throws Exception {
        Pet pet = null;

        mockMvc.perform(post("/pet/delete")
                .param("pet", Long.toString(pet.getId()))
                .with(csrf()));

        assertFalse(petRepository.findById(pet.getId()).isPresent());
    }

    @Test
    @WithUserDetails("vet1@petclinic.com")
    void deleteUnsuccessfully() throws Exception {
        Pet pet = null;

        mockMvc.perform(post("/pet/delete")
                .param("pet", Long.toString(pet.getId()))
                .with(csrf()));

        assertTrue(petRepository.findById(pet.getId()).isPresent());
    }

    @Test
    void editSuccessfully() throws Exception {
    }

    @Test
    void editUnsuccessfully() throws Exception {
    }

    @Test
    void createSuccessfully() throws Exception {
    }
}