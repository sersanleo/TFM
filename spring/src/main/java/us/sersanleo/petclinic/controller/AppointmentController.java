package us.sersanleo.petclinic.controller;

import static us.sersanleo.petclinic.Util.getUser;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Sort;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import us.sersanleo.petclinic.models.Appointment;
import us.sersanleo.petclinic.models.User;
import us.sersanleo.petclinic.repository.AppointmentRepository;
import us.sersanleo.petclinic.repository.UserRepository;
import us.sersanleo.petclinic.service.AppointmentService;
import us.sersanleo.petclinic.service.PetService;

@Controller
@RequestMapping("/appointment")
public class AppointmentController {
    @Autowired
    private AppointmentRepository appointmentRepository;
    @Autowired
    private AppointmentService appointmentService;
    @Autowired
    private PetService petService;
    @Autowired
    private UserRepository userRepository;

    private void addFormOptionsToModel(User user, Model model) {
        model.addAttribute("pets", petService.visibleBy(user));
        model.addAttribute("vets", userRepository.findAllVets());
    }

    public static void validateAppointment(Appointment appointment, BindingResult bindingResult,
            PetService petService, AppointmentRepository appointmentRepository, AppointmentService appointmentService) {
        if (!bindingResult.hasFieldErrors("vet") && !appointment.getVet().isStaff())
            bindingResult.rejectValue("vet", "user.notVet");
        if (!bindingResult.hasFieldErrors("pet") && !petService.visibleBy(getUser(), appointment.getPet()))
            bindingResult.rejectValue("pet", "pet.notOwner");
        if (!bindingResult.hasFieldErrors("date") && !bindingResult.hasFieldErrors("vet") && appointmentService
                .concurs(appointment.getId(), appointment.getVet().getId(), appointment.getDate()))
            bindingResult.rejectValue("date", "appointment.concurrent");
    }

    @GetMapping
    public String list(Model model, @RequestParam(required = false, defaultValue = "0") int page) {
        model.addAttribute("pagination", appointmentService.visibleBy(getUser(),
                PageRequest.of(page, 10).withSort(Sort.Direction.DESC, "id")));
        return "appointment/list";
    }

    @GetMapping("/create")
    public String getCreate(Model model) {
        addFormOptionsToModel(getUser(), model);
        model.addAttribute("appointment", new Appointment());
        return "appointment/edit";
    }

    @PostMapping("/create")
    public String postCreate(@Valid Appointment appointment, BindingResult bindingResult, Model model) {
        validateAppointment(appointment, bindingResult, petService, appointmentRepository, appointmentService);
        if (bindingResult.hasErrors()) {
            addFormOptionsToModel(getUser(), model);
            return "appointment/edit";
        }
        appointmentRepository.save(appointment);
        return "redirect:/appointment";
    }

    @PostMapping("/delete")
    public String delete(@RequestParam Long appointment) {
        if (appointmentService.visibleBy(appointment, getUser()))
            appointmentRepository.deleteById(appointment);
        return "redirect:/appointment";
    }

    @GetMapping("/{appointmentId}")
    public String getEdit(@PathVariable Long appointmentId, Model model) {
        if (!appointmentService.visibleBy(appointmentId, getUser()))
            return "redirect:/appointment";
        addFormOptionsToModel(getUser(), model);
        model.addAttribute("appointment", appointmentRepository.findById(appointmentId));
        return "appointment/edit";
    }

    @PostMapping("/{appointmentId}")
    public String postEdit(@PathVariable Long appointmentId, @Valid Appointment appointment,
            BindingResult bindingResult, Model model) {
        if (appointmentService.visibleBy(appointmentId, getUser())) {
            appointment.setId(appointmentId);
            validateAppointment(appointment, bindingResult, petService, appointmentRepository, appointmentService);
            if (bindingResult.hasErrors()) {
                addFormOptionsToModel(getUser(), model);
                return "appointment/edit";
            }
            appointment.setId(appointmentId);
            appointmentRepository.save(appointment);
        }
        return "redirect:/appointment";
    }
}