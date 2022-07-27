package us.sersanleo.petclinic.controller;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.PageRequest;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import us.sersanleo.petclinic.models.Pet;
import us.sersanleo.petclinic.repository.PetRepository;

@Controller
@RequestMapping(path = "/pet")
public class PetController {
    @Autowired
    private PetRepository petRepository;

    @GetMapping()
    public String list(Model model, @RequestParam(required = false, defaultValue = "0") int page) {
        model.addAttribute("pagination", petRepository.findAll(PageRequest.of(page, 10)));
        return "pet/list";
    }

    @GetMapping("/create")
    public String getCreate(Model model) {
        model.addAttribute("pet", new Pet());
        return "pet/edit";
    }

    @PostMapping("/create")
    public String postCreate(@Valid Pet pet, BindingResult bindingResult) {
        return "pet/edit";
    }
}