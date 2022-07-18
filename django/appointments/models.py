from msilib.schema import DrLocator
from django.core.validators import *
from django.db.models import *
from django.contrib.auth import get_user_model

from pets.models import Pet


class Appointment(Model):
    pet = ForeignKey(Pet, PROTECT, verbose_name='Mascota', null=False,
                     blank=False)
    vet = ForeignKey(get_user_model(), PROTECT, verbose_name='Veterinario', null=False,
                     blank=False, limit_choices_to=Q())

    date = DateTimeField('Fecha y hora', null=False, blank=False)
    annotations = TextField('Anotaciones', blank=False, null=True)

    created_at = DateTimeField(null=False,  auto_now_add=True)
    updated_at = DateTimeField(null=False,  auto_now=True)

    class Meta:
        verbose_name = 'Cita'
        verbose_name_plural = 'Citas'
        default_related_name = 'appointments'
        ordering = ('-date',)
