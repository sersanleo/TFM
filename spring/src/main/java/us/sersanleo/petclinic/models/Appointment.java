package us.sersanleo.petclinic.models;

import java.sql.Timestamp;
import java.util.Date;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Lob;
import javax.persistence.ManyToOne;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;
import javax.validation.Valid;
import javax.validation.constraints.Future;
import javax.validation.constraints.NotNull;

import org.springframework.data.annotation.CreatedDate;
import org.springframework.data.annotation.LastModifiedDate;

@Entity
public class Appointment {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @NotNull
    @Valid
    @ManyToOne(optional = false)
    private Pet pet;

    @NotNull
    @Valid
    @ManyToOne(optional = false)
    private User vet;

    @NotNull
    @Future
    @Temporal(TemporalType.TIMESTAMP)
    private Date date;

    @Lob
    private String annotations;

    @NotNull
    @CreatedDate
    private Timestamp createdAt;

    @NotNull
    @LastModifiedDate
    private Timestamp updatedAt;
}
