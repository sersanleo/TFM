package us.sersanleo.petclinic.controller.api;

import static us.sersanleo.petclinic.Util.getUser;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Sort;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import us.sersanleo.petclinic.models.Appointment;
import us.sersanleo.petclinic.service.AppointmentService;

@RestController
@RequestMapping("/api/appointment")
public class AppointmentAPIController {
    @Autowired
    private AppointmentService appointmentService;

    @GetMapping
    public Page<Appointment> list(@RequestParam(required = false, defaultValue = "0") int page) {
        return appointmentService.visibleBy(getUser(),
                PageRequest.of(page, 10).withSort(Sort.Direction.DESC, "id"));
    }
}