from django.contrib.auth import get_user_model
from django.forms import *
from pets.models import Pet

from .models import Appointment


class AppointmentForm(ModelForm):
    class Meta:
        model = Appointment
        exclude = ('created_at', 'updated_at')
        widgets = {'date': DateTimeInput(format='%Y-%m-%dT%H:%M', attrs={'type': 'datetime-local'}),
                   'annotations': Textarea(attrs={'style': 'height:7rem'})}

    def __init__(self, user, *args, **kwargs):
        kwargs['label_suffix'] = ''
        super().__init__(*args, **kwargs)

        self.fields['pet'].queryset = Pet.objects.visible_by(user)
        self.fields['vet'].queryset = get_user_model(
        ).objects.filter(is_staff=True)

        for field in self.fields.values():
            if type(field.widget) == Select:
                class_name = 'form-select'
            elif type(field.widget) == CheckboxInput:
                class_name = 'form-check-input'
            else:
                class_name = 'form-control'
            field.widget.attrs.update(
                {'class': class_name, 'placeholder': field.label})

    def clean_date(self):
        data = self.cleaned_data['date']
        if data.weekday() > 4:
            raise ValidationError(
                'Los fines de semana no se pueden reservar citas.')
        return data

    def is_valid(self):
        result = super().is_valid()
        for x in (self.fields if '__all__' in self.errors else self.errors):
            attrs = self.fields[x].widget.attrs
            attrs.update({'class': attrs.get('class', '') + ' is-invalid'})
        return result
