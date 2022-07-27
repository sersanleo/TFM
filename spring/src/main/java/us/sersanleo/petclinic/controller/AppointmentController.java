package us.sersanleo.petclinic.controller;

import javax.validation.Valid;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;

import us.sersanleo.petclinic.models.Pet;

@Controller
@RequestMapping(path = "/appointment")
public class AppointmentController {
    @GetMapping()
    public String list() {
        return "index";
    }

    @GetMapping("/create")
    public String getCreate(Model model) {
        model.addAttribute("pet", new Pet());
        return "login";
    }

    @PostMapping("/create")
    public String postCreate(@Valid Pet pet, BindingResult bindingResult) {
        return "login";
    }
}