// Importamos lo necesario de Vue
import { ref, onMounted } from 'vue';
import { MongoClient } from 'mongodb';

export default {
  setup() {
    // Creamos una referencia reactiva para almacenar los productos
    const productos = ref([]);

    // Función para cargar los productos desde la base de datos
    const cargarProductos = async () => {
      const client = new MongoClient('mongodb://localhost:27017');
      await client.connect();
      const database = client.db('mi_base_de_datos');
      const collection = database.collection('productos');

      // Obtenemos los productos y los asignamos a la variable reactiva
      productos.value = await collection.find({}).toArray();
    };

    // Cargamos los productos al iniciar la página
    onMounted(() => {
      cargarProductos();
    });

    return {
      productos
    };
  }
};

