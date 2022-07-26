package us.sersanleo.petclinic.models;

import java.util.Date;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Transient;
import javax.validation.constraints.Email;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.NotEmpty;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import javax.validation.constraints.Size;

import org.springframework.format.annotation.DateTimeFormat;

import us.sersanleo.petclinic.models.validation.EqualFields;

@Entity
@EqualFields(baseField = "password", matchField = "passwordConfirmation", message = "la confirmación de contraseña no coincide")
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
    @Size(min = 8, max = 255)
    private String password;

    @Transient
    private String passwordConfirmation;

    @NotEmpty
    @NotBlank
    @NotNull
    @Size(max = 150)
    private String firstName;

    @NotEmpty
    @NotBlank
    @NotNull
    @Size(max = 150)
    private String lastName;

    @NotEmpty
    @NotBlank
    @NotNull
    @Size(max = 300)
    private String address;

    @NotNull
    @Past
    @DateTimeFormat(pattern = "yyyy-MM-dd")
    private Date birthday;

    @Column(columnDefinition = "boolean default false")
    @NotNull
    private boolean isStaff = false;

    public Long getId() {
        return this.id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getEmail() {
        return this.email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return this.password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getFirstName() {
        return this.firstName;
    }

    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public String getLastName() {
        return this.lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public String getAddress() {
        return this.address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public Date getBirthday() {
        return this.birthday;
    }

    public void setBirthday(Date birthday) {
        this.birthday = birthday;
    }

    public boolean getIsStaff() {
        return this.isStaff;
    }

    public void setIsStaff(boolean isStaff) {
        this.isStaff = isStaff;
    }

    public boolean isIsStaff() {
        return this.isStaff;
    }

    public String getPasswordConfirmation() {
        return this.passwordConfirmation;
    }

    public void setPasswordConfirmation(String passwordConfirmation) {
        this.passwordConfirmation = passwordConfirmation;
    }

    @Override
    public String toString() {
        return this.firstName + " " + this.lastName;
    }
}