package us.sersanleo.petclinic.models;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.UniqueConstraint;
import javax.validation.Valid;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

@Entity
@Table(uniqueConstraints = {
        @UniqueConstraint(columnNames = { "species_id", "race" })
})
public class PetRace {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @NotNull
    @Valid
    @ManyToOne(optional = false)
    private PetSpecies species;

    @NotNull
    @Size(max = 30)
    private String race;

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public PetSpecies getSpecies() {
        return this.species;
    }

    public void setSpecies(PetSpecies species) {
        this.species = species;
    }

    public String getRace() {
        return this.race;
    }

    public void setRace(String race) {
        this.race = race;
    }

    @Override
    public String toString() {
        return this.race.length() > 0 ? this.species.getName() + " (" + this.race + ")" : this.species.getName();
    }
}
