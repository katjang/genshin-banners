<script setup lang="ts">
import { ref } from 'vue'
import * as countdown from "countdown";

const props = defineProps<{
    start_date: Date;
}>();



const months = ref(0);
const days = ref(0);
const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);

let timer = countdown(props.start_date, (ts: any) => {
    months.value = ts.months;
    days.value = ts.days;
    hours.value = ts.hours;
    minutes.value = ts.minutes;
    seconds.value = ts.seconds;
}, [countdown.MONTHS, countdown.DAYS, countdown.HOURS, countdown.MINUTES, countdown.SECONDS]);


</script>

<template>
    <div>
         {{ months }} Months, {{ days }} Days
    </div>
   <div>
        {{ hours }}:{{ minutes }}:{{ seconds }}
   </div>
</template>
