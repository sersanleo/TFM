package us.sersanleo.petclinic.service;

import java.util.Date;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.stereotype.Service;

import us.sersanleo.petclinic.models.Appointment;
import us.sersanleo.petclinic.models.User;
import us.sersanleo.petclinic.repository.AppointmentRepository;

@Service
public class AppointmentService {
    @Autowired
    private AppointmentRepository appointmentRepository;

    public boolean visibleBy(Long id, User user) {
        return user.isStaff() || appointmentRepository.visibleBy(id, user.getId());
    }

    public Page<Appointment> visibleBy(User user, Pageable pageable) {
        if (user.isStaff())
            return appointmentRepository.findAll(pageable);
        else
            return appointmentRepository.findAllByPetOwnerId(user.getId(), pageable);
    }

    public List<Appointment> visibleBy(User user) {
        if (user.isStaff())
            return appointmentRepository.findAll();
        else
            return appointmentRepository.findAllByPetOwnerId(user.getId());
    }

    public boolean concurs(Long id, Long vetId, Date date) {
        if (id != null)
            return appointmentRepository.concurs(id, vetId, date);
        return appointmentRepository.concurs(vetId, date);
    }
}