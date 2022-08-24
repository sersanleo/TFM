package us.sersanleo.petclinic;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertFalse;
import static org.junit.jupiter.api.Assertions.assertTrue;
import static org.springframework.security.test.web.servlet.request.SecurityMockMvcRequestPostProcessors.csrf;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.post;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

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

import us.sersanleo.petclinic.models.Appointment;
import us.sersanleo.petclinic.models.Pet;
import us.sersanleo.petclinic.models.PetRace;
import us.sersanleo.petclinic.models.PetSpecies;
import us.sersanleo.petclinic.models.User;
import us.sersanleo.petclinic.repository.AppointmentRepository;
import us.sersanleo.petclinic.repository.PetRaceRepository;
import us.sersanleo.petclinic.repository.PetRepository;
import us.sersanleo.petclinic.repository.PetSpeciesRepository;
import us.sersanleo.petclinic.repository.UserRepository;

@ExtendWith(SpringExtension.class)
@SpringBootTest
@AutoConfigureMockMvc
@AutoConfigureTestDatabase
@Transactional
class AppointmentTests {
    private static final SimpleDateFormat DATETIME_FORMATTER = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm");

    @Autowired
    private MockMvc mockMvc;
    @Autowired
    private AppointmentRepository appointmentRepository;
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
    private Appointment appointment1, appointment2;

    private static final int posMod(int a, int b) {
        int res = a % b;
        if (res < 0)
            res += b;
        return res;
    }

    @BeforeEach
    void setup() {
        Calendar birthday = Calendar.getInstance();
        birthday.set(2000, 0, 1);
        vet = userRepository.save(
                new User("vet1@petclinic.com", passwordEncoder.encode("vet1"), "Test vet1", "Test",
                        "Test address",
                        birthday.getTime(), true));
        customer1 = userRepository
                .save(new User("customer1@petclinic.com", passwordEncoder.encode("customer1"),
                        "Test customer1", "Test",
                        "Test address", birthday.getTime()));
        customer2 = userRepository
                .save(new User("customer2@petclinic.com", passwordEncoder.encode("customer2"),
                        "Test customer2", "Test",
                        "Test address", birthday.getTime()));

        PetSpecies perro = petSpeciesRepository.save(new PetSpecies("Perro")),
                gato = petSpeciesRepository.save(new PetSpecies("Gato"));
        chihuahua = petRaceRepository.save(new PetRace(perro, "Chihuahua"));
        siames = petRaceRepository.save(new PetRace(gato, "Siamés"));
        pet1 = petRepository.save(new Pet(customer1, chihuahua, "Firulais"));
        pet2 = petRepository.save(new Pet(customer2, siames, "Bob"));

        Calendar proximoLunes = Calendar.getInstance();
        proximoLunes.set(Calendar.SECOND, 0);
        proximoLunes.add(Calendar.DATE, 1);
        proximoLunes.add(Calendar.DATE, posMod(-(proximoLunes.get(Calendar.DAY_OF_WEEK) - 2), 7));
        Calendar appointment2Date = (Calendar) proximoLunes.clone();
        appointment2Date.add(Calendar.DATE, 1);
        appointment1 = appointmentRepository.save(new Appointment(pet1, vet, proximoLunes.getTime()));
        appointment2 = appointmentRepository.save(new Appointment(pet2, vet, appointment2Date.getTime()));
    }

    @Test
    @WithUserDetails(value = "vet1@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void deleteSuccessfully() throws Exception {
        Appointment appointment = appointment1;

        mockMvc.perform(post("/appointment/delete")
                .param("appointment", appointment.getId().toString())
                .with(csrf()));

        assertFalse(appointmentRepository.findById(appointment.getId()).isPresent());
    }

    @Test
    @WithUserDetails(value = "customer2@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void deleteUnsuccessfully() throws Exception {
        Appointment appointment = appointment1;

        mockMvc.perform(post("/appointment/delete")
                .param("appointment", appointment.getId().toString())
                .with(csrf()));

        assertTrue(appointmentRepository.findById(appointment.getId()).isPresent());
    }

    @Test
    @WithUserDetails(value = "vet1@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void editSuccessfully() throws Exception {
        Appointment appointment = appointment1;
        Calendar newDate = Calendar.getInstance();
        newDate.setTime(appointment.getDate());
        newDate.add(Calendar.DATE, 7);

        mockMvc.perform(post("/appointment/{appointmentId}", appointment.getId())
                .param("pet", appointment.getPet().getId().toString())
                .param("vet", appointment.getVet().getId().toString())
                .param("date", DATETIME_FORMATTER.format(newDate.getTime()))
                .with(csrf()));

        assertEquals(DATETIME_FORMATTER
                .format(appointmentRepository.findById(appointment.getId()).get().getDate()),
                DATETIME_FORMATTER.format(newDate.getTime()));
    }

    @Test
    @WithUserDetails(value = "vet1@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void editUnsuccessfully() throws Exception {
        Appointment appointment = appointment1;
        Date newDate = appointment2.getDate();

        mockMvc.perform(post("/appointment/{appointmentId}", appointment.getId())
                .param("pet", appointment.getPet().getId().toString())
                .param("vet", appointment.getVet().getId().toString())
                .param("date", DATETIME_FORMATTER.format(newDate))
                .with(csrf()));

        assertEquals(DATETIME_FORMATTER
                .format(appointmentRepository.findById(appointment.getId()).get().getDate()),
                DATETIME_FORMATTER.format(appointment.getDate()));
    }

    @Test
    @WithUserDetails(value = "vet1@petclinic.com", setupBefore = TestExecutionEvent.TEST_EXECUTION)
    void createSuccessfully() throws Exception {
        appointmentRepository.deleteAll(); // Eliminamos todas las citas para evitar colisiones de fecha
        long count = appointmentRepository.count();

        mockMvc.perform(post("/appointment/create")
                .param("pet", pet1.getId().toString())
                .param("vet", vet.getId().toString())
                .param("date", DATETIME_FORMATTER.format(appointment1.getDate()))
                .with(csrf()));

        assertEquals(appointmentRepository.count(), count + 1);
    }
}