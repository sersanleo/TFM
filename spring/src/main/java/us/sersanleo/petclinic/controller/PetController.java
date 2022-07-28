package us.sersanleo.petclinic.controller;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.PageRequest;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import us.sersanleo.petclinic.models.Pet;
import us.sersanleo.petclinic.repository.PetRaceRepository;
import us.sersanleo.petclinic.repository.PetRepository;
import us.sersanleo.petclinic.repository.UserRepository;

@Controller
@RequestMapping(path = "/pet")
public class PetController {
    @Autowired
    private PetRepository petRepository;
    @Autowired
    private PetRaceRepository petRaceRepository;
    @Autowired
    private UserRepository userRepository;

    @GetMapping()
    public String list(Model model, @RequestParam(required = false, defaultValue = "0") int page) {
        model.addAttribute("pagination", petRepository.findAll(PageRequest.of(page, 10)));
        return "pet/list";
    }

    private void addFormOptionsToModel(Model model) {
        model.addAttribute("races", petRaceRepository.findAll());
        model.addAttribute("users", userRepository.findAll());
    }

    @GetMapping("/create")
    public String getCreate(Model model) {
        addFormOptionsToModel(model);
        model.addAttribute("pet", new Pet());
        return "pet/edit";
    }

    @PostMapping("/create")
    public String postCreate(@Valid Pet pet, BindingResult bindingResult, Model model) {
        addFormOptionsToModel(model);

        if (bindingResult.hasErrors())
            return "pet/edit";
        petRepository.save(pet);
        return "redirect:/pet";
    }

    @PostMapping("/delete")
    public String delete(@RequestParam Long pet) {
        petRepository.deleteById(pet);
        return "redirect:/pet";
    }

    @GetMapping("/{id}")
    public String getEdit(@PathVariable(value = "id") Long id, Model model) {
        addFormOptionsToModel(model);
        model.addAttribute("pet", petRepository.findById(id));
        return "pet/edit";
    }

    @PostMapping("/{id}")
    public String postEdit(@Valid Pet pet, BindingResult bindingResult, Model model) {
        addFormOptionsToModel(model);

        if (bindingResult.hasErrors())
            return "pet/edit";
        petRepository.save(pet);
        return "redirect:/pet";
    }
}