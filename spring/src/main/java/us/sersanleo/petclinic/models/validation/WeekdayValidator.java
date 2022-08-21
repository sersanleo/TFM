package us.sersanleo.petclinic.models.validation;

import java.util.Calendar;
import java.util.Date;

import javax.validation.ConstraintValidator;
import javax.validation.ConstraintValidatorContext;

public class WeekdayValidator implements ConstraintValidator<WeekdayConstraint, Date> {
    @Override
    public boolean isValid(Date value, ConstraintValidatorContext context) {
        if (value != null) {
            Calendar cal = Calendar.getInstance();
            cal.setTime(value);
            return (cal.get(Calendar.DAY_OF_WEEK) - 2) % 7 < 5;
        }
        return false;
    }

}