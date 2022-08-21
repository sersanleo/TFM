from datetime import date, timedelta

from appointments.models import *
from django.test import TestCase
from django.urls import reverse
from django.utils import timezone
from pets.models import *

from .models import *


class RegisterTestCase(TestCase):
    def setUp(self):
        self.vet = User.objects.create_superuser(email='vet1@petclinic.com', password='vet1', first_name='Test vet1',
                                                 last_name='Test', address='Test address', birthday=date(1999, 8, 10))
        self.customer1 = User.objects.create_user(email='customer1@petclinic.com', password='customer1', first_name='Test customer1',
                                                  last_name='Test', address='Test address', birthday=date(1999, 8, 10))
        self.customer2 = User.objects.create_user(email='customer2@petclinic.com', password='customer2', first_name='Test customer2',
                                                  last_name='Test', address='Test address', birthday=date(1999, 8, 10))

        PetSpecies.objects.bulk_create([
            PetSpecies(name='Perro'),
            PetSpecies(name='Gato'),
        ])
        PetRace.objects.bulk_create([
            PetRace(race='Chihuahua',
                    species=PetSpecies.objects.get(name='Perro')),
            PetRace(race='Siamés', species=PetSpecies.objects.get(name='Gato')),
        ])
        Pet.objects.bulk_create([
            Pet(owner=User.objects.get(email='customer1@petclinic.com'),
                race=PetRace.objects.get(race='Chihuahua'), name='Firulais'),
            Pet(owner=User.objects.get(email='customer2@petclinic.com'),
                race=PetRace.objects.get(race='Siamés'), name='Bob'),
        ])

        hoy = timezone.now() + timedelta(days=1)
        proximo_lunes = hoy + timedelta(days=(0 - hoy.weekday()) % 7)
        Appointment.objects.bulk_create([
            Appointment(pet=Pet.objects.get(name='Firulais'),
                        vet=User.objects.get(email='vet1@petclinic.com'), date=proximo_lunes),
            Appointment(pet=Pet.objects.get(name='Bob'),
                        vet=User.objects.get(email='vet1@petclinic.com'), date=proximo_lunes+timedelta(hours=1)),
        ])

    def test_register_successfully(self):
        email = 'email@email.com'
        response = self.client.post(reverse('register'), {
            'email': email,
            'password1': 'Password235',
            'password2': 'Password235',
            'first_name': 'Test',
            'last_name': 'Test',
            'address': 'Test',
            'birthday': '2000-01-01',
        })
        self.assertRedirects(response, expected_url=reverse('login'))
        self.assertTrue(User.objects.filter(email=email).exists())

    def test_register_error(self):
        email = 'email@email.com'
        response = self.client.post(reverse('register'), {
            'email': email,
            'password1': 'Password235',
            'password2': 'incorrect',
            'first_name': 'Test',
            'last_name': 'Test',
            'address': 'Test',
            'birthday': '2000-01-01',
        })
        self.assertEquals(response.status_code, 200)
        self.assertFalse(User.objects.filter(email=email).exists())

    def test_login_successfully(self):
        response = self.client.post(reverse('login'), {
            'username': self.vet.email,
            'password': 'vet1'
        })
        self.assertEquals(response.status_code, 302)
