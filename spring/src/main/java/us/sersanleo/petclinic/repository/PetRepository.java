package us.sersanleo.petclinic.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import us.sersanleo.petclinic.models.Pet;

@Repository
public interface PetRepository extends JpaRepository<Pet, Long> {

}