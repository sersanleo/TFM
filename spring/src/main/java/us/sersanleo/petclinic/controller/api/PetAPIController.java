package us.sersanleo.petclinic.controller.api;

import static us.sersanleo.petclinic.Util.getUser;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Sort;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.validation.annotation.Validated;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseStatus;
import org.springframework.web.bind.annotation.RestController;

import us.sersanleo.petclinic.models.Pet;
import us.sersanleo.petclinic.repository.PetRepository;
import us.sersanleo.petclinic.service.PetService;

@RestController
@RequestMapping("/api/pet")
public class PetAPIController {
    @Autowired
    private PetService petService;
    @Autowired
    private PetRepository petRepository;

    @GetMapping
    public Page<Pet> list(@RequestParam(required = false, defaultValue = "0") int page) {
        return petService.visibleBy(getUser(), PageRequest.of(page, 10).withSort(Sort.Direction.DESC, "id"));
    }

    @GetMapping("/{petId}")
    public ResponseEntity<Pet> get(@PathVariable Long petId) {
        Optional<Pet> pet = petRepository.findById(petId);
        return pet.isPresent() ? ResponseEntity.ok().body(pet.get()) : ResponseEntity.notFound().build();
    }

    @PostMapping
    public ResponseEntity create(@Validated @RequestBody Pet pet) {
        petRepository.save(pet);
        return ResponseEntity.status(HttpStatus.CREATED).build();
    }

    @PutMapping("/{petId}")
    public ResponseEntity update(@PathVariable Long petId, @Validated @RequestBody Pet pet) {
        pet.setId(petId);
        petRepository.save(pet);
        return ResponseEntity.status(HttpStatus.CREATED).build();
    }

    @DeleteMapping("/{petId}")
    @ResponseStatus(HttpStatus.NO_CONTENT)
    public void delete(@PathVariable Long petId) {
        petRepository.deleteById(petId);
    }
}
