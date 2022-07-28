package us.sersanleo.petclinic.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.stereotype.Service;

import us.sersanleo.petclinic.models.Pet;
import us.sersanleo.petclinic.models.User;
import us.sersanleo.petclinic.repository.PetRepository;

@Service
public class PetService {
    @Autowired
    private PetRepository petRepository;

    public boolean visibleBy(User user, Pet pet) {
        return user.isStaff() || pet.getOwner().getId().equals(user.getId());
    }

    public Page<Pet> visibleBy(User user, Pageable pageable) {
        if (user.isStaff())
            return petRepository.findAll(pageable);
        else
            return petRepository.findAllByOwnerId(user.getId(), pageable);
    }

    public List<Pet> visibleBy(User user) {
        if (user.isStaff())
            return petRepository.findAll();
        else
            return petRepository.findAllByOwnerId(user.getId());
    }
}
