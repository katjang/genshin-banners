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

function pad(num: number, size: number): string {
    var s = "00000" + num;
    return s.substring(s.length-size);
}

</script>

<template>
    <v-row justify="center" class="text-h4" no-gutters>
        <v-col cols="auto" v-if="months">
             {{ months }} Months
        </v-col>
        <v-col cols="auto" v-if="days">
            {{ days }} Days
        </v-col>
    </v-row>
    <v-row class="text-h5">
        <v-col class="text-center pt-1">
            {{ pad(hours,2) }}:{{ pad(minutes,2) }}:{{ pad(seconds,2) }}
        </v-col>
    </v-row>
</template>
