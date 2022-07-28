package us.sersanleo.petclinic.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import us.sersanleo.petclinic.models.PetRace;

@Repository
public interface PetRaceRepository extends JpaRepository<PetRace, Long> {
}