package us.sersanleo.petclinic.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import us.sersanleo.petclinic.models.Appointment;

@Repository
public interface AppointmentRepository extends JpaRepository<Appointment, Long> {
}