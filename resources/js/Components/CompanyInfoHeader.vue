<script setup>
import CompanyLogo from "@/Components/CompanyLogo.vue";
import { Tag } from "primevue";
import { useI18n } from 'vue-i18n';
import StatCardGroup from "@/Components/StatCardGroup.vue";

const props = defineProps({
    company: {
        type: Object,
        required: true
    },
});

const {n} = useI18n();

const company = props.company;

const companyTags = {
    "Ticker": company.ticker,
    "ISIN": company.isin,
};

const companyStats = [
    {
        title: 'Marktkap.',
        value: n(company.market_capitalization, 'currencyUSDCompact'),
    },
    {
        title: 'Branche',
        value: company.sector.name,
        route: route('sectors.show', {sector: company.sector.id})
    },
    {
        title: 'Land',
        value: company.country.name,
        route: route('countries.show', {country: company.country.id})
    },
    {
        title: 'Börsenplatz',
        value: company.exchange.name,
    },
];
</script>

<template>
    <div class="flex space-x-16">
        <company-logo :logo-path="company.logo" class="max-w-[20%] max-h-24"/>
        <div>
            <h1 class="text-4xl font-bold">{{ company.name }}</h1>
            <div class="flex space-x-3 mt-2">
                <tag v-for="(value, key) in companyTags" severity="secondary">
                    <template #default>
                        <div class="text-lg">
                            {{ key }} <span class="font-light">{{ value }}</span>
                        </div>
                    </template>
                </tag>
            </div>
        </div>
    </div>
    <stat-card-group :stats="companyStats"/>
</template>
