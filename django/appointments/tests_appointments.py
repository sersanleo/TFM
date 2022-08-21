from datetime import timedelta

from django.test import RequestFactory, TestCase
from django.urls import reverse
from django.utils import timezone
from petclinic.models import *
from pets.models import *

from appointments import views
from appointments.models import *


class AppointmentTestCase(TestCase):
    def setUp(self):
        self.factory = RequestFactory()

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

    def test_delete_successfully(self):
        appointment_count = Appointment.objects.count()
        appointment = Appointment.objects.first()

        request = self.factory.post(reverse('appointment:delete'), {
            'appointment': appointment.pk
        })
        request.user = self.vet

        views.delete(request)
        self.assertEquals(Appointment.objects.count(), appointment_count - 1)

    def test_delete_unsuccessfully(self):
        customer = self.customer1
        appointment_count = Appointment.objects.count()
        appointment = Appointment.objects.exclude(pet__owner=customer).first()

        request = self.factory.post(reverse('appointment:delete'), {
            'appointment': appointment.pk
        })
        request.user = customer

        views.delete(request)
        self.assertEquals(Appointment.objects.count(), appointment_count)

    def test_edit_successfully(self):
        appointment = Appointment.objects.first()
        new_date = appointment.date + timedelta(days=7)
        request = self.factory.post(reverse('appointment:edit', args=[appointment.pk]), {
            'pet': appointment.pet.pk,
            'vet': appointment.vet.pk,
            'date': new_date
        })
        request.user = self.vet

        response = views.edit(request, pk=appointment.pk)
        self.assertEquals(Appointment.objects.first().date, new_date)
        self.assertEquals(response.status_code, 302)

    def test_edit_unsuccessfully(self):
        appointment = Appointment.objects.first()
        new_date = Appointment.objects.last().date
        request = self.factory.post(reverse('appointment:edit', args=[appointment.pk]), {
            'pet': appointment.pet.pk,
            'vet': appointment.vet.pk,
            'date': new_date
        })
        request.user = self.vet

        response = views.edit(request, pk=appointment.pk)
        self.assertEquals(
            Appointment.objects.first().date, appointment.date)
        self.assertEquals(response.status_code, 200)

    def test_create_successfully(self):
        appointment_count = Appointment.objects.count()

        hoy = timezone.now() + timedelta(days=1)
        proximo_martes = hoy + timedelta(days=(1 - hoy.weekday()) % 7)
        request = self.factory.post(reverse('appointment:create'), {
            'pet': Pet.objects.first().pk,
            'vet': self.vet.pk,
            'date': proximo_martes
        })
        request.user = self.vet

        response = views.edit(request)
        self.assertEquals(Appointment.objects.count(), appointment_count + 1)
        self.assertEquals(response.status_code, 302)
