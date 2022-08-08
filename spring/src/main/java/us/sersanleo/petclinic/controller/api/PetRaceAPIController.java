package us.sersanleo.petclinic.controller.api;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import us.sersanleo.petclinic.models.PetRace;
import us.sersanleo.petclinic.repository.PetRaceRepository;

@RestController
@RequestMapping("/api/petrace")
public class PetRaceAPIController {
    @Autowired
    private PetRaceRepository petRaceRepository;

    @GetMapping
    public List<PetRace> list() {
        return petRaceRepository.findAll();
    }
}
