package us.sersanleo.petclinic;

import org.springframework.security.core.context.SecurityContextHolder;

import us.sersanleo.petclinic.config.UserDetailsServiceImpl.UserDetailsImpl;
import us.sersanleo.petclinic.models.User;

public class Util {
    public static final User getUser() {
        return ((UserDetailsImpl) SecurityContextHolder.getContext().getAuthentication()
                .getPrincipal()).getUser();
    }
}
