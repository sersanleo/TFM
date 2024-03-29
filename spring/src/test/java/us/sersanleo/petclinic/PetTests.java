package us.sersanleo.petclinic;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertFalse;
import static org.junit.jupiter.api.Assertions.assertTrue;
import static org.springframework.security.test.web.servlet.request.SecurityMockMvcRequestPostProcessors.csrf;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.post;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.model;

import java.text.SimpleDateFormat;
import java.util.Calendar;

import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.jdbc.AutoConfigureTestDatabase;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.test.context.support.TestExecutionEvent;
import org.springframework.security.test.context.support.WithUserDetails;
import org.springframework.test.context.junit.jupiter.SpringExtension;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.transaction.annotation.Transactional;

import us.sersanleo.petclinic.models.Pet;
import us.sersanleo.petclinic.models.PetRace;
import us.sersanleo.petclinic.models.PetSpecies;
import us.sersanleo.petclinic.models.User;
import us.sersanleo.petclinic.repository.PetRaceRepository;
import us.sersanleo.petclinic.repository.PetRepository;
import us.sersanleo.petclinic.repository.PetSpeciesRepository;
import us.sersanleo.petclinic.repository.UserRepository;

@ExtendWith(SpringExtension.class)
@SpringBootTest
@AutoConfigureMockMvc
@AutoConfigureTestDatabase
@Transactional
class PetTests {
    private static final SimpleDateFormat DATE_FORMATTER = new SimpleDateFormat("yyyy-MM-dd");

    @Autowired
    private MockMvc mockMvc;
    @Autowired
    private PetSpeciesRepository petSpeciesRepository;
    @Autowired
    private PetRaceRepository petRaceRepository;
    @Autowired
    private PetRepository petRepository;
    @Autowired
    private UserRepository userRepository;
    @Autowired
    PasswordEncoder passwordEncoder = null;

    private User vet, customer1, customer2;
    private PetRace chihuahua, siames;
    private Pet pet1, pet2;

    @BeforeEach
    void setup() {
        Calendar birthday = Calendar.getInstance();
        birthday.set(2000, 0, 1);
        vet = userRepository.save(
                new User("vet1@petclinic.com", passwordEncoder.encode("vet1"), "Test vet1", "Test", "Test address",
                        birthday.getTime(), true));
        customer1 = userRepository
                .save(new User("customer1@petclinic.com", passwordEncoder.encode("customer1"), "Test customer1", "Test",
                        "Test address", birthday.getTime()));
        customer2 = userRepository
                .save(new User("customer2@petclinic.com", passwordEncoder.encode("customer2"), "Test customer2", "Test",
                        "Test address", birthday.getTime()));

        PetSpecies perro = petSpeciesRepository.save(new PetSpecies("Perro")),
                gato = petSpeciesRepository.save(new PetSpecies("Gato"));
        chihuahua = petRaceRepository.save(new PetRace(perro, "Chihuahua"));
        siames = petRaceRepository.save(new PetRace(gato, "Siamés"));
        pet1 = petRepository.save(new Pet(customer1, chihuahua, "Firulais"));
        pet2 = petRepository.save(new Pet(customer2, siames, "Bob"));
    }

    @Test
    @WithUserDetails(value = "vet1@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void deleteSuccessfully() throws Exception {
        Pet pet = this.pet1;

        mockMvc.perform(post("/pet/delete")
                .param("pet", pet.getId().toString())
                .with(csrf()));

        assertFalse(petRepository.findById(pet.getId()).isPresent());
    }

    @Test
    @WithUserDetails(value = "customer1@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void deleteUnsuccessfully() throws Exception {
        Pet pet = this.pet2;

        mockMvc.perform(post("/pet/delete")
                .param("pet", pet.getId().toString())
                .with(csrf()));

        assertTrue(petRepository.findById(pet.getId()).isPresent());
    }

    @Test
    @WithUserDetails(value = "vet1@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void editSuccessfully() throws Exception {
        Pet pet = this.pet1;
        String newName = pet.getName() + "test";

        mockMvc.perform(post("/pet/{petId}", pet.getId())
                .param("owner", pet.getOwner().getId().toString())
                .param("race", pet.getRace().getId().toString())
                .param("name", newName)
                .with(csrf()));

        assertEquals(petRepository.findById(pet.getId()).get().getName(), newName);
    }

    @Test
    @WithUserDetails(value = "vet1@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void editUnsuccessfully() throws Exception {
        Pet pet = this.pet1;
        Calendar birthday = Calendar.getInstance();
        birthday.add(Calendar.DATE, 1);

        mockMvc.perform(post("/pet/{petId}", pet.getId())
                .param("owner", pet.getOwner().getId().toString())
                .param("race", pet.getRace().getId().toString())
                .param("name", pet.getName())
                .param("birthday", DATE_FORMATTER.format(birthday.getTime()))
                .with(csrf()))
                .andExpect(model().attributeHasFieldErrors("pet", "birthday"));

        assertEquals(petRepository.findById(pet.getId()).get().getBirthday(), pet.getBirthday());
    }

    @Test
    @WithUserDetails(value = "vet1@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void createSuccessfully() throws Exception {
        long count = petRepository.count();

        mockMvc.perform(post("/pet/create")
                .param("owner", customer1.getId().toString())
                .param("race", chihuahua.getId().toString())
                .param("name", "Test pet")
                .with(csrf()));

        assertEquals(petRepository.count(), count + 1);
    }
}