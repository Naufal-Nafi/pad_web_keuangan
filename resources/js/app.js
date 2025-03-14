import './bootstrap';
import 'flowbite';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);
window.Chart = Chart;