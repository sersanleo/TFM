package us.sersanleo.petclinic.serializer;

import java.io.IOException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;

import com.fasterxml.jackson.core.JacksonException;
import com.fasterxml.jackson.core.JsonParser;
import com.fasterxml.jackson.databind.DeserializationContext;
import com.fasterxml.jackson.databind.JsonDeserializer;
import com.fasterxml.jackson.databind.JsonNode;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.jackson.JsonComponent;

import us.sersanleo.petclinic.models.Appointment;
import us.sersanleo.petclinic.repository.PetRepository;
import us.sersanleo.petclinic.repository.UserRepository;

@JsonComponent
public class AppointmentDeserializer extends JsonDeserializer<Appointment> {
    private static final DateFormat DATETIME_FORMAT = new SimpleDateFormat("yyyy-MM-dd HH:mm");
    @Autowired
    private UserRepository userRepository;
    @Autowired
    private PetRepository petRepository;

    @Override
    public Appointment deserialize(JsonParser jsonParser, DeserializationContext deserializationContext)
            throws IOException, JacksonException {
        JsonNode node = jsonParser.getCodec().readTree(jsonParser);
        Appointment appointment = new Appointment();
        appointment.setPet(petRepository.findById(node.get("pet").asLong()).orElse(null));
        appointment.setVet(userRepository.findById(node.get("vet").asLong()).orElse(null));
        try {
            appointment.setDate(DATETIME_FORMAT.parse(node.get("date").asText()));
        } catch (ParseException e) {
        }
        appointment.setAnnotations(node.get("annotations").asText(null));
        return appointment;
    }
}