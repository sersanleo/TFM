package us.sersanleo.petclinic.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.http.HttpMethod;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityCustomizer;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;

@Configuration
public class SecurityConfig {
    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }

    @Bean
    public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
        http.headers().frameOptions().sameOrigin();
        http.csrf().ignoringAntMatchers("/api/**").and().httpBasic();
        http.authorizeRequests()
                .antMatchers("/").permitAll()
                .antMatchers("/login", "/register").anonymous()
                .antMatchers("/pet/?**").hasAnyAuthority("VET")
                .antMatchers(HttpMethod.GET, "/api/pet/**").authenticated()
                .antMatchers("/api/pet/**").hasAnyAuthority("VET")
                .anyRequest().authenticated()
                .and().formLogin().loginPage("/login").loginProcessingUrl("/login")
                .and().logout().deleteCookies("JSESSIONID").logoutSuccessUrl("/");
        return http.build();
    }

    @Bean
    public WebSecurityCustomizer webSecurityCustomizer() {
        return (web) -> web.ignoring().antMatchers("/**.css*");
    }
}