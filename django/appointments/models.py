from django.contrib.auth import get_user_model
from django.core.validators import *
from django.db.models import *
from django.utils import timezone
from pets.models import Pet


class Appointment(Model):
    pet = ForeignKey(Pet, CASCADE, verbose_name='Mascota', null=False,
                     blank=False)
    vet = ForeignKey(get_user_model(), PROTECT, verbose_name='Veterinario',
                     null=False, blank=False)

    date = DateTimeField('Fecha y hora', null=False, blank=False,
                         validators=(MinValueValidator(timezone.now),))
    annotations = TextField('Anotaciones', blank=True, null=True)

    created_at = DateTimeField(null=False,  auto_now_add=True)
    updated_at = DateTimeField(null=False,  auto_now=True)

    class Meta:
        verbose_name = 'Cita'
        verbose_name_plural = 'Citas'
        default_related_name = 'appointments'
        ordering = ('-date',)
        unique_together = (('vet', 'date'),)

    class AppointmentQuerySet(QuerySet):
        def visible_by(self, user):
            if user.is_superuser:
                return self.all()
            return self.filter(pet__owner=user)

    objects = AppointmentQuerySet().as_manager()
