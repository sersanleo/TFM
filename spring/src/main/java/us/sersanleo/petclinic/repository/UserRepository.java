package us.sersanleo.petclinic.repository;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import us.sersanleo.petclinic.models.User;

@Repository
public interface UserRepository extends JpaRepository<User, Long> {
    Optional<User> findByEmail(String email);

    @Query("select case when count(c) > 0 then true else false end from User c where lower(c.email) like lower(:email)")
    boolean existsEmail(@Param("email") String email);
}