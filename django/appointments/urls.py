from django.urls import path

from . import views

app_name = 'appointment'
urlpatterns = [
    path('', views.list, name=''),
    path('create', views.edit, name='create'),
    path('delete', views.delete, name='delete'),
    path('<int:pk>', views.edit, name='edit'),
]
