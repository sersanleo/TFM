from datetime import datetime, timedelta

from appointments.models import *
from django.http import HttpResponse
from django.test import RequestFactory, TestCase
from django.urls import reverse
from petclinic.models import *

from pets import views
from pets.models import *


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

        self.factory = RequestFactory()

    def test_delete_successfully(self):
        pet_count = Pet.objects.count()
        pet = Pet.objects.first()

        request = self.factory.post(reverse('pet:delete'), {
            'pet': pet.pk
        })
        request.user = self.vet

        views.delete(request)
        self.assertEquals(Pet.objects.count(), pet_count - 1)

    def test_delete_unsuccessfully(self):
        pet_count = Pet.objects.count()
        pet = Pet.objects.first()

        request = self.factory.post(reverse('pet:delete'), {
            'pet': pet.pk
        })
        request.user = self.customer1

        views.delete(request)
        self.assertEquals(Pet.objects.count(), pet_count)

    def test_edit_successfully(self):
        pet = Pet.objects.first()
        new_name = pet.name + 'test'
        request = self.factory.post(reverse('pet:edit', args=[pet.pk]), {
            'owner': pet.owner.pk,
            'race': pet.race.pk,
            'name': new_name
        })
        request.user = self.vet

        response = views.edit(request, pk=pet.pk)
        self.assertEquals(Pet.objects.first().name, new_name)
        self.assertEquals(response.status_code, 302)

    def test_edit_unsuccessfully(self):
        pet = Pet.objects.first()
        request = self.factory.post(reverse('pet:edit', args=[pet.pk]), {
            'owner': pet.owner.pk,
            'race': pet.race.pk,
            'name': pet.name,
            'birthday':  (datetime.now() + timedelta(days=1)).strftime('%Y-%m-%d')
        })
        request.user = self.vet

        response = views.edit(request, pk=pet.pk)
        self.assertEquals(Pet.objects.first().birthday, pet.birthday)
        self.assertEquals(response.status_code, 200)

    def test_create_successfully(self):
        pet_count = Pet.objects.count()

        request = self.factory.post(reverse('pet:create'), {
            'owner': self.customer1.pk,
            'race': PetRace.objects.first().pk,
            'name': 'Test pet'
        })
        request.user = self.vet

        response = views.edit(request)
        self.assertEquals(Pet.objects.count(), pet_count + 1)
        self.assertEquals(response.status_code, 302)
