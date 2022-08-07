package us.sersanleo.petclinic.serializer;

import java.io.IOException;

import com.fasterxml.jackson.core.JsonGenerator;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.JsonSerializer;
import com.fasterxml.jackson.databind.SerializerProvider;

import org.springframework.boot.jackson.JsonComponent;

import us.sersanleo.petclinic.models.Pet;

@JsonComponent
public class PetSerializer extends JsonSerializer<Pet> {
    @Override
    public void serialize(Pet pet, JsonGenerator jsonGenerator,
            SerializerProvider serializerProvider) throws IOException,
            JsonProcessingException {
        jsonGenerator.writeStartObject();
        jsonGenerator.writeObjectField("id", pet.getId());
        jsonGenerator.writeObjectField("annotations", pet.getAnnotations());
        jsonGenerator.writeObjectField("birthday", pet.getBirthday());
        jsonGenerator.writeObjectField("name", pet.getName());
        jsonGenerator.writeObjectField("sex", pet.getSex());
        jsonGenerator.writeObjectField("deceased", pet.isDeceased());
        jsonGenerator.writeObjectField("owner_id", pet.getOwner().getId());
        jsonGenerator.writeObjectField("created_at", pet.getCreatedAt());
        jsonGenerator.writeObjectField("updated_at", pet.getUpdatedAt());
        jsonGenerator.writeObjectField("race", pet.getRace());
        jsonGenerator.writeEndObject();
    }
}