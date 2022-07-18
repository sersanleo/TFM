package us.sersanleo.petclinic.models;

import java.sql.Timestamp;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Lob;
import javax.persistence.ManyToOne;
import javax.validation.constraints.NotNull;

import org.springframework.data.annotation.CreatedDate;
import org.springframework.data.annotation.LastModifiedDate;

@Entity
public class Appointment {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    @ManyToOne(optional = false)
    private Pet pet;

    @ManyToOne(optional = false)
    private User vet;

    @NotNull
    private Timestamp date;

    @Lob
    private String annotations;

    @NotNull
    @CreatedDate
    private Timestamp created_at;

    @NotNull
    @LastModifiedDate
    private Timestamp updated_at;
}
