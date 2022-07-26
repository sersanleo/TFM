package us.sersanleo.petclinic.models;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.UniqueConstraint;
import javax.validation.Valid;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.NotEmpty;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

@Entity
@Table(uniqueConstraints = {
        @UniqueConstraint(columnNames = { "species_id", "race" })
})
public class PetRace {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    @NotNull
    @Valid
    @ManyToOne(optional = false)
    private PetSpecies species;

    @NotEmpty
    @NotBlank
    @Size(max = 30)
    private String race;
}
