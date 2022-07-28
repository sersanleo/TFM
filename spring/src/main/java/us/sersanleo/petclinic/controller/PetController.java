package us.sersanleo.petclinic.controller;

import static us.sersanleo.petclinic.Util.getUser;

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
import us.sersanleo.petclinic.service.PetService;

@Controller
@RequestMapping(path = "/pet")
public class PetController {
    @Autowired
    private PetRepository petRepository;
    @Autowired
    private PetService petService;
    @Autowired
    private PetRaceRepository petRaceRepository;
    @Autowired
    private UserRepository userRepository;

    @GetMapping()
    public String list(Model model, @RequestParam(required = false, defaultValue = "0") int page) {
        model.addAttribute("pagination", petService.visibleBy(getUser(), PageRequest.of(page, 10)));
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
        if (bindingResult.hasErrors()) {
            addFormOptionsToModel(model);
            return "pet/edit";
        }
        petRepository.save(pet);
        return "redirect:/pet";
    }

    @PostMapping("/delete")
    public String delete(@RequestParam Long pet) {
        petRepository.deleteById(pet);
        return "redirect:/pet";
    }

    @GetMapping("/{petId}")
    public String getEdit(@PathVariable Long petId, Model model) {
        addFormOptionsToModel(model);
        model.addAttribute("pet", petRepository.findById(petId));
        return "pet/edit";
    }

    @PostMapping("/{petId}")
    public String postEdit(@PathVariable Long petId, @Valid Pet pet, BindingResult bindingResult, Model model) {
        if (bindingResult.hasErrors()) {
            addFormOptionsToModel(model);
            return "pet/edit";
        }
        pet.setId(petId);
        petRepository.save(pet);
        return "redirect:/pet";
    }
}