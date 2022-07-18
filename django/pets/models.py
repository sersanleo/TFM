from django.core.validators import *
from django.db.models import *
from django.contrib.auth import get_user_model


class PetSpecies(Model):
    name = CharField('Nombre', max_length=20,
                     blank=False, null=False, unique=True)

    class Meta:
        verbose_name = 'Especie'
        verbose_name_plural = 'Especies'

    def __str__(self):
        return self.name


class PetRace(Model):
    species = ForeignKey(PetSpecies, PROTECT,
                         verbose_name='Especie', null=False,  blank=False)
    race = CharField('Raza', max_length=30, blank=True, null=True)

    class Meta:
        verbose_name = 'Raza'
        verbose_name_plural = 'Razas'
        default_related_name = 'races'
        unique_together = (('species', 'race'),)
        ordering = ('species__name', 'race')

    class Manager(Manager):
        def get_queryset(self):
            return super().get_queryset().prefetch_related('species')

    objects = Manager()

    def __str__(self):
        return '{0} {1}'.format(self.species.name, self.race.lower()) if self.race else self.species.name


class Pet(Model):
    class Sexes(TextChoices):
        Female = 'F', 'Hembra'
        Male = 'M', 'Macho'

    owner = ForeignKey(get_user_model(), PROTECT, verbose_name='Dueño', null=False,
                       blank=False, limit_choices_to=Q())
    race = ForeignKey(PetRace, PROTECT, verbose_name='Raza',
                      null=True,  blank=True)

    name = CharField('Nombre', max_length=30, blank=False, null=False)
    sex = CharField('Sexo', choices=Sexes.choices,
                    max_length=1, blank=True, null=True)
    birthday = DateField('Cumpleaños', blank=True, null=True)
    annotations = TextField('Anotaciones', blank=True, null=True)

    created_at = DateTimeField(null=False,  auto_now_add=True)
    updated_at = DateTimeField(null=False,  auto_now=True)

    class Meta:
        verbose_name = 'Mascota'
        verbose_name_plural = 'Mascotas'
        default_related_name = 'pets'
        ordering = ('-created_at',)

    def __str__(self):
        return self.name
