package us.sersanleo.petclinic.repository;

import java.util.Date;
import java.util.List;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import us.sersanleo.petclinic.models.Appointment;

@Repository
public interface AppointmentRepository extends JpaRepository<Appointment, Long> {
    List<Appointment> findAllByPetOwnerId(Long ownerId);

    Page<Appointment> findAllByPetOwnerId(Long ownerId, Pageable pageable);

    @Query("SELECT CASE WHEN COUNT(appointment) > 0 THEN true ELSE false END FROM Appointment appointment WHERE appointment.id = :appointmentId AND appointment.pet.owner.id = :userId")
    boolean visibleBy(Long appointmentId, Long userId);

    @Query("SELECT CASE WHEN COUNT(appointment) > 0 THEN true ELSE false END FROM Appointment appointment WHERE appointment.id <> :id AND appointment.vet.id = :vetId AND appointment.date = :date")
    boolean concurs(Long id, Long vetId, Date date);

    @Query("SELECT CASE WHEN COUNT(appointment) > 0 THEN true ELSE false END FROM Appointment appointment WHERE appointment.vet.id = :vetId AND appointment.date = :date")
    boolean concurs(Long vetId, Date date);
}