package us.sersanleo.petclinic.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import us.sersanleo.petclinic.models.PetSpecies;

@Repository
public interface PetSpeciesRepository extends JpaRepository<PetSpecies, Long> {
}