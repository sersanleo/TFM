package us.sersanleo.petclinic.models.validation;

import java.lang.annotation.Documented;
import java.lang.annotation.ElementType;
import java.lang.annotation.Retention;
import java.lang.annotation.RetentionPolicy;
import java.lang.annotation.Target;

import javax.validation.Constraint;
import javax.validation.Payload;

@Documented
@Constraint(validatedBy = WeekdayValidator.class)
@Target({ ElementType.METHOD, ElementType.FIELD })
@Retention(RetentionPolicy.RUNTIME)
public @interface WeekdayConstraint {
    String message() default "Las citas solo pueden ser días entresemana";

    Class<?>[] groups() default {};

    Class<? extends Payload>[] payload() default {};
}