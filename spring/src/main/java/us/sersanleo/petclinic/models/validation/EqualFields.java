package us.sersanleo.petclinic.models.validation;

import java.lang.annotation.ElementType;
import java.lang.annotation.Retention;
import java.lang.annotation.RetentionPolicy;
import java.lang.annotation.Target;
import java.lang.reflect.Field;

import javax.validation.Constraint;
import javax.validation.ConstraintValidator;
import javax.validation.ConstraintValidatorContext;
import javax.validation.Payload;

import us.sersanleo.petclinic.models.validation.EqualFields.EqualFieldsValidator;

@Target(ElementType.TYPE)
@Retention(RetentionPolicy.RUNTIME)
@Constraint(validatedBy = EqualFieldsValidator.class)
public @interface EqualFields {

    String message() default "los campos no coinciden";

    Class<?>[] groups() default {};

    Class<? extends Payload>[] payload() default {};

    String baseField();

    String matchField();

    public class EqualFieldsValidator implements ConstraintValidator<EqualFields, Object> {
        private String baseField;
        private String matchField;

        @Override
        public void initialize(EqualFields constraint) {
            baseField = constraint.baseField();
            matchField = constraint.matchField();
        }

        @Override
        public boolean isValid(Object object, ConstraintValidatorContext context) {
            try {
                Object baseFieldValue = getFieldValue(object, baseField);
                Object matchFieldValue = getFieldValue(object, matchField);
                return baseFieldValue != null && baseFieldValue.equals(matchFieldValue);
            } catch (Exception e) {
                return false;
            }
        }

        private Object getFieldValue(Object object, String fieldName) throws Exception {
            Class<?> clazz = object.getClass();
            Field passwordField = clazz.getDeclaredField(fieldName);
            passwordField.setAccessible(true);
            return passwordField.get(object);
        }
    }
}