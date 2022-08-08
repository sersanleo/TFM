package us.sersanleo.petclinic.serializer;

import java.io.IOException;

import com.fasterxml.jackson.core.JsonGenerator;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.JsonSerializer;
import com.fasterxml.jackson.databind.SerializerProvider;

import org.springframework.boot.jackson.JsonComponent;

import us.sersanleo.petclinic.models.User;

@JsonComponent
public class UserSerializer extends JsonSerializer<User> {
    @Override
    public void serialize(User user, JsonGenerator jsonGenerator,
            SerializerProvider serializerProvider) throws IOException,
            JsonProcessingException {
        jsonGenerator.writeStartObject();
        jsonGenerator.writeObjectField("id", user.getId());
        jsonGenerator.writeObjectField("first_name", user.getFirstName());
        jsonGenerator.writeObjectField("last_name", user.getLastName());
        jsonGenerator.writeEndObject();
    }
}