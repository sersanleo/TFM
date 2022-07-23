from django.contrib.admin.views.decorators import staff_member_required
from django.contrib.auth.decorators import login_required
from django.core.paginator import Paginator
from django.http import Http404
from django.shortcuts import redirect, render

from .forms import *


@staff_member_required
def edit(request, pk=None):
    if pk:
        pet = Pet.objects.visible_by(request.user).filter(pk=pk)
        if pet.exists():
            pet = pet.first()
        else:
            raise Http404()
    else:
        pet = Pet(owner=request.user)

    if request.method == 'POST':
        form = PetForm(request.POST, instance=pet)
        if form.is_valid():
            form.save()
            return redirect('pet:')
    else:
        form = PetForm(instance=pet)
    return render(request, 'pet/edit.html', {'form': form})


@staff_member_required
def delete(request):
    if request.method == 'POST':
        Pet.objects.visible_by(request.user).filter(
            pk=request.POST['pet']).delete()
    return redirect('pet:')


@login_required
def list(request):
    return render(request, 'pet/list.html', {
        'page_obj': Paginator(Pet.objects.visible_by(request.user), 10).get_page(request.GET.get('page', 1))
    })
