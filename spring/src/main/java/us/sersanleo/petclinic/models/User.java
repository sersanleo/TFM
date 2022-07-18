package us.sersanleo.petclinic.models;

import java.sql.Date;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.validation.constraints.Email;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.NotEmpty;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

import org.springframework.format.annotation.DateTimeFormat;

@Entity
public class User {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    @NotEmpty
    @NotBlank
    @NotNull
    @Email
    @Size(max = 254)
    @Column(unique = true)
    private String email;

    @NotEmpty
    @NotBlank
    @NotNull
    @Size(max = 300)
    private String address;

    @NotNull
    @DateTimeFormat(pattern = "dd/MM/yyyy")
    private Date birthday;
}