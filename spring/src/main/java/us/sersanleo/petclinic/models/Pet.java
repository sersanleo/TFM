package us.sersanleo.petclinic.models;

import java.sql.Date;
import java.sql.Timestamp;

import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Lob;
import javax.persistence.ManyToOne;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.NotEmpty;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

import org.springframework.data.annotation.CreatedDate;
import org.springframework.data.annotation.LastModifiedDate;

@Entity
public class Pet {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    @ManyToOne(optional = false)
    private User user;

    @ManyToOne(optional = false)
    private PetRace race;

    @NotEmpty
    @NotBlank
    @NotNull
    @Size(max = 30)
    private String name;

    @Enumerated(EnumType.ORDINAL)
    private Sex sex;

    private Date birthday;

    @Lob
    private String annotations;

    @NotNull
    @CreatedDate
    private Timestamp created_at;

    @NotNull
    @LastModifiedDate
    private Timestamp updated_at;

    public static enum Sex {
        OPEN, REVIEW, APPROVED, REJECTED;
    }
}
