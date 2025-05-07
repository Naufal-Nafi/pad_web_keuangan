import './bootstrap';
import 'flowbite';
import { Chart, registerables } from 'chart.js';
import { CountUp } from 'countup.js';

Chart.register(...registerables);
window.Chart = Chart;


document.addEventListener('DOMContentLoaded', () => {
    const options = {
        decimal: ",",
        separator: ".",
        prefix: "Rp. ",
        duration: 1.4
    };

    const profit = new CountUp('profit', document.getElementById('profit').dataset.val, options);
    const income = new CountUp('income', document.getElementById('income').dataset.val, options);
    const expense = new CountUp('expense', document.getElementById('expense').dataset.val, options);

    if (!profit.error) profit.start();
    if (!income.error) income.start();
    if (!expense.error) expense.start();
});