// Importamos lo necesario de Vue
import { ref } from 'vue';
import { MongoClient } from 'mongodb';

export default {
  setup() {
    // Creamos referencias reactivas para los datos del nuevo producto
    const nombre = ref('');
    const precio = ref(0);
    const cantidad = ref(0);

    // Función para agregar un nuevo producto a la base de datos
    const agregarProducto = async () => {
      const client = new MongoClient('mongodb://localhost:27017');
      await client.connect();
      const database = client.db('mi_base_de_datos');
      const collection = database.collection('productos');

      // Insertamos el nuevo producto en la colección
      await collection.insertOne({ nombre: nombre.value, precio: precio.value, cantidad: cantidad.value });
      alert('Producto agregado exitosamente');
      
      // Limpiamos los campos después de agregar el producto
      nombre.value = '';
      precio.value = 0;
      cantidad.value = 0;
    };

    return {
      nombre,
      precio,
      cantidad,
      agregarProducto
    };
  }
};
