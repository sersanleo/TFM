package us.sersanleo.petclinic.controller.api;

import static us.sersanleo.petclinic.Util.getUser;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Sort;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.validation.BindingResult;
import org.springframework.validation.ObjectError;
import org.springframework.validation.annotation.Validated;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import us.sersanleo.petclinic.controller.AppointmentController;
import us.sersanleo.petclinic.models.Appointment;
import us.sersanleo.petclinic.repository.AppointmentRepository;
import us.sersanleo.petclinic.service.AppointmentService;
import us.sersanleo.petclinic.service.PetService;

@RestController
@RequestMapping("/api/appointment")
public class AppointmentAPIController {
    @Autowired
    private AppointmentService appointmentService;
    @Autowired
    private AppointmentRepository appointmentRepository;
    @Autowired
    private PetService petService;

    private final ResponseEntity<Object> getErrorResponse(BindingResult bindingResult) {
        List<String> details = new ArrayList<>();
        for (ObjectError error : bindingResult.getAllErrors())
            details.add(error.getDefaultMessage());
        return new ResponseEntity(details, HttpStatus.BAD_REQUEST);
    }

    @GetMapping
    public Page<Appointment> list(@RequestParam(required = false, defaultValue = "0") int page) {
        return appointmentService.visibleBy(getUser(),
                PageRequest.of(page, 10).withSort(Sort.Direction.DESC, "id"));
    }

    @GetMapping("/{appointmentId}")
    public ResponseEntity<Appointment> get(@PathVariable Long appointmentId) {
        if (!appointmentService.visibleBy(appointmentId, getUser()))
            return ResponseEntity.status(HttpStatus.FORBIDDEN).build();
        Optional<Appointment> appointment = appointmentRepository.findById(appointmentId);
        return appointment.isPresent() ? ResponseEntity.ok().body(appointment.get())
                : ResponseEntity.notFound().build();
    }

    @PostMapping
    public ResponseEntity create(@Validated @RequestBody Appointment appointment, BindingResult bindingResult) {
        AppointmentController.validateAppointment(appointment, bindingResult, petService, appointmentRepository,
                appointmentService);
        if (bindingResult.hasErrors())
            return getErrorResponse(bindingResult);
        appointmentRepository.save(appointment);
        return ResponseEntity.status(HttpStatus.CREATED).build();
    }

    @PutMapping("/{appointmentId}")
    public ResponseEntity update(@PathVariable Long appointmentId, @Validated @RequestBody Appointment appointment,
            BindingResult bindingResult) {
        if (appointmentService.visibleBy(appointmentId, getUser())) {
            AppointmentController.validateAppointment(appointment, bindingResult, petService, appointmentRepository,
                    appointmentService);
            if (bindingResult.hasErrors())
                return getErrorResponse(bindingResult);
            appointment.setId(appointmentId);
            appointmentRepository.save(appointment);
            return ResponseEntity.status(HttpStatus.CREATED).build();
        }
        return ResponseEntity.status(HttpStatus.FORBIDDEN).build();
    }

    @DeleteMapping("/{appointmentId}")
    public ResponseEntity delete(@PathVariable Long appointmentId) {
        if (appointmentService.visibleBy(appointmentId, getUser())) {
            appointmentRepository.deleteById(appointmentId);
            return ResponseEntity.status(HttpStatus.NO_CONTENT).build();
        }
        return ResponseEntity.status(HttpStatus.FORBIDDEN).build();
    }
}