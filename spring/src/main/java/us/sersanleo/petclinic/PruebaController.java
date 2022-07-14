package us.sersanleo.petclinic;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class PruebaController {
    @GetMapping("/login")
    public String login(Model model) {
        return "login";
    }

    @GetMapping("/register")
    public String register(Model model) {
        return "register";
    }
}