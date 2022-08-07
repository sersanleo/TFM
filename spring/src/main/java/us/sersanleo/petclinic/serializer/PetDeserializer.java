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

import us.sersanleo.petclinic.models.Pet;
import us.sersanleo.petclinic.models.Pet.Sex;
import us.sersanleo.petclinic.repository.PetRaceRepository;
import us.sersanleo.petclinic.repository.UserRepository;

@JsonComponent
public class PetDeserializer extends JsonDeserializer<Pet> {
    private static final DateFormat DATE_FORMAT = new SimpleDateFormat("yyyy-MM-dd");
    @Autowired
    private UserRepository userRepository;
    @Autowired
    private PetRaceRepository petRaceRepository;

    @Override
    public Pet deserialize(JsonParser jsonParser, DeserializationContext deserializationContext)
            throws IOException, JacksonException {
        JsonNode node = jsonParser.getCodec().readTree(jsonParser);
        Pet pet = new Pet();
        pet.setOwner(userRepository.findById(node.get("owner").asLong()).orElse(null));
        pet.setRace(petRaceRepository.findById(node.get("race").asLong()).orElse(null));
        pet.setName(node.get("name").asText());
        pet.setSex(Sex.valueOf(node.get("sex").asText()));
        try {
            pet.setBirthday(DATE_FORMAT.parse(node.get("birthday").asText()));
        } catch (ParseException e) {
        }
        pet.setAnnotations(node.get("annotations").asText(null));
        pet.setDeceased(node.get("deceased").asBoolean(false));
        return pet;
    }
}