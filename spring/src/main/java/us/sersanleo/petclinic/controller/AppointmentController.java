package us.sersanleo.petclinic.controller;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.PageRequest;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import us.sersanleo.petclinic.models.Appointment;
import us.sersanleo.petclinic.repository.AppointmentRepository;
import us.sersanleo.petclinic.repository.PetRepository;

@Controller
@RequestMapping(path = "/appointment")
public class AppointmentController {
    @Autowired
    private AppointmentRepository appointmentRepository;
    @Autowired
    private PetRepository petRepository;

    @GetMapping()
    public String list(Model model, @RequestParam(required = false, defaultValue = "0") int page) {
        model.addAttribute("pagination", appointmentRepository.findAll(PageRequest.of(page, 10)));
        return "appointment/list";
    }

    private void addFormOptionsToModel(Model model) {

    }

    @GetMapping("/create")
    public String getCreate(Model model) {
        addFormOptionsToModel(model);
        model.addAttribute("appointment", new Appointment());
        return "appointment/edit";
    }

    @PostMapping("/create")
    public String postCreate(@Valid Appointment appointment, BindingResult bindingResult, Model model) {
        addFormOptionsToModel(model);

        if (bindingResult.hasErrors())
            return "appointment/edit";
        appointmentRepository.save(appointment);
        return "redirect:/appointment";
    }

    @PostMapping("/delete")
    public String delete(@RequestParam Long appointment) {
        appointmentRepository.deleteById(appointment);
        return "redirect:/appointment";
    }

    @GetMapping("/{id}")
    public String getEdit(@PathVariable(value = "id") Long id, Model model) {
        addFormOptionsToModel(model);
        model.addAttribute("appointment", appointmentRepository.findById(id));
        return "appointment/edit";
    }

    @PostMapping("/{id}")
    public String postEdit(@Valid Appointment appointment, BindingResult bindingResult, Model model) {
        addFormOptionsToModel(model);

        if (bindingResult.hasErrors())
            return "appointment/edit";
        appointmentRepository.save(appointment);
        return "redirect:/appointment";
    }
}