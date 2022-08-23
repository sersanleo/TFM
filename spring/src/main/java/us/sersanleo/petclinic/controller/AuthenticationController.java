package us.sersanleo.petclinic.controller;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import us.sersanleo.petclinic.models.User;
import us.sersanleo.petclinic.repository.UserRepository;

@Controller
public class AuthenticationController {
    @Autowired
    private UserRepository userRepository;
    @Autowired
    private PasswordEncoder passwordEncoder;

    @GetMapping
    public String index() {
        return "index";
    }

    @GetMapping("/login")
    public String login() {
        return "login";
    }

    @GetMapping("/register")
    public String getRegister(Model model) {
        model.addAttribute("user", new User());
        return "register";
    }

    @PostMapping("/register")
    public String postRegister(@Valid User user, BindingResult bindingResult) {
        if (userRepository.existsEmail(user.getEmail()))
            bindingResult.rejectValue("email", "email.nonUnique");
        if (!user.getPassword().equals(user.getPasswordConfirmation()))
            bindingResult.rejectValue("passwordConfirmation", "password.notMatching");

        if (bindingResult.hasErrors())
            return "register";
        String encodedPassword = passwordEncoder.encode(user.getPassword());
        user.setPassword(encodedPassword);
        user.setPasswordConfirmation(encodedPassword);
        userRepository.save(user);
        return "redirect:/login";
    }
}