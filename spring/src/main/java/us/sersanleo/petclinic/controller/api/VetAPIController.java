package us.sersanleo.petclinic.controller.api;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import us.sersanleo.petclinic.models.User;
import us.sersanleo.petclinic.repository.UserRepository;

@RestController
@RequestMapping("/api/vet")
public class VetAPIController {
    @Autowired
    private UserRepository userRepository;

    @GetMapping
    public List<User> list() {
        return userRepository.findAllVets();
    }
}
