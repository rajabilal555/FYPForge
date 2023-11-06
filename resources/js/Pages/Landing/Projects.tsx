import { Link, Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import { Fragment, useState } from "react";
import { Dialog, Disclosure, Popover, Transition } from "@headlessui/react";
import {
    ArrowPathIcon,
    Bars3Icon,
    ChartPieIcon,
    CursorArrowRaysIcon,
    FingerPrintIcon,
    SquaresPlusIcon,
    XMarkIcon,
} from "@heroicons/react/24/outline";
import {
    ChevronDownIcon,
    PhoneIcon,
    PlayCircleIcon,
} from "@heroicons/react/20/solid";
import { DataTable } from "@/Components/ui/data-table";
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import { ColumnDef } from "@tanstack/react-table";

export default function Projects({}: PageProps<{}>) {
    const navigation = [
        { name: "Home", href: "#" },
        { name: "Projects", href: "#" },
        { name: "Alumni", href: "#" },
        { name: "Contact", href: "#" },
    ];
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

    const projectData = [
        {
            "member1-name": "Hanium Iqbal",
            "member2-name": "Laiba Hasan",
            "project-topic": "HERsheild",
            "new-advisor": "Dr. Adeel Ansari",
        },
        {
            "member1-name": "Aman .",
            "member2-name": "",
            "project-topic": "MotoMate",
            "new-advisor": "Mr. Khawaja Mohiuddin",
        },
        {
            "member1-name": "Mahad Khan",
            "member2-name": "Hasnain Ali",
            "project-topic": "Hunger Bounce / Learning Vouage Adventure",
            "new-advisor": "Dr. Hasnain Mansoor",
        },
        {
            "member1-name": "Fiza Muhammad Amin",
            "member2-name": "Qurat Ul Ain Sikandar",
            "project-topic": "szabist faculty app 2",
            "new-advisor": "Dr. Khalid Rasheed",
        },
        {
            "member1-name": "Muhammad Bilal Pasta",
            "member2-name": "Muskaan Fatima",
            "project-topic": "Trackify",
            "new-advisor": "Dr. Faraz Junejo",
        },
        {
            "member1-name": "Ahmed Bin Abdullah",
            "member2-name": "Sheheryar Khan Afridi",
            "project-topic": "HOPE",
            "new-advisor": "Mr. Usama Khalid",
        },
        {
            "member1-name": "Faiez Waseem",
            "member2-name": "Muhammad Hamza Shamsi",
            "project-topic": "AtmoWork",
            "new-advisor": "Ms. Sadia Aziz",
        },
        {
            "member1-name": "Prerna Rohra",
            "member2-name": "Qirat Sohail",
            "project-topic": "Earthquake Predictor / Intensity Minimizer",
            "new-advisor": "Dr. Khalid Rasheed",
        },
        {
            "member1-name": "Eman Mughal",
            "member2-name": "Salima Karim Bux Karimi",
            "project-topic": "Style Haven",
            "new-advisor": "Mr. Adeel Karim",
        },
        {
            "member1-name": "Sarah Amir",
            "member2-name": "Javeria Shaikh",
            "project-topic": "Automatic Parking system",
            "new-advisor": "Ms. Faria Jameel",
        },
    ];

    const columns: ColumnDef<Record<string, string>>[] = [
        {
            accessorKey: "member1-name",
            header: "Member 1",
            enableColumnFilter: false,
        },
        {
            accessorKey: "member2-name",
            header: "Member 2",
            enableColumnFilter: false,
        },
        {
            accessorKey: "project-topic",
            header: "Project",
            enableColumnFilter: false,
        },
        {
            accessorKey: "new-advisor",
            header: "Advisor",
            enableColumnFilter: false,
        },
    ];

    return (
        <>
            <div className="bg-white">
                <header className="absolute inset-x-0 top-0 z-50">
                    <nav
                        className="flex items-center justify-between p-6 lg:px-8"
                        aria-label="Global"
                    >
                        <div className="flex lg:flex-1">
                            <a href="#" className="-m-1.5 p-1.5">
                                <span className="sr-only">FYP Forge</span>
                                <div className="font-bold text-3xl text-primary">
                                    FYP Forge
                                </div>
                                {/* <img className="h-8 w-auto" src="" alt="" /> */}
                            </a>
                        </div>
                        <div className="flex lg:hidden">
                            <button
                                type="button"
                                className="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                                onClick={() => setMobileMenuOpen(true)}
                            >
                                <span className="sr-only">Open main menu</span>
                                <Bars3Icon
                                    className="h-6 w-6"
                                    aria-hidden="true"
                                />
                            </button>
                        </div>
                        <div className="hidden lg:flex lg:gap-x-12">
                            {navigation.map((item) => (
                                <a
                                    key={item.name}
                                    href={item.href}
                                    className="text-sm font-semibold leading-6 text-gray-700"
                                >
                                    {item.name}
                                </a>
                            ))}
                        </div>
                        <div className="hidden lg:flex lg:flex-1 lg:justify-end">
                            <a
                                href="#"
                                className="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >
                                Get started
                            </a>
                            {/* <a
                                href="#"
                                className="text-sm font-semibold leading-6 text-gray-900"
                            >
                                Log in <span aria-hidden="true">&rarr;</span>
                            </a> */}
                        </div>
                    </nav>
                    <Dialog
                        as="div"
                        className="lg:hidden"
                        open={mobileMenuOpen}
                        onClose={setMobileMenuOpen}
                    >
                        <div className="fixed inset-0 z-50" />
                        <Dialog.Panel className="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                            <div className="flex items-center justify-between">
                                <a href="#" className="-m-1.5 p-1.5">
                                    <div className="font-bold text-3xl text-primary">
                                        FYP Forge
                                    </div>
                                </a>
                                <button
                                    type="button"
                                    className="-m-2.5 rounded-md p-2.5 text-gray-700"
                                    onClick={() => setMobileMenuOpen(false)}
                                >
                                    <span className="sr-only">Close menu</span>
                                    <XMarkIcon
                                        className="h-6 w-6"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                            <div className="mt-6 flow-root">
                                <div className="-my-6 divide-y divide-gray-500/10">
                                    <div className="space-y-2 py-6">
                                        {navigation.map((item) => (
                                            <a
                                                key={item.name}
                                                href={item.href}
                                                className="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                            >
                                                {item.name}
                                            </a>
                                        ))}
                                    </div>
                                    <div className="py-6">
                                        <a
                                            href="#"
                                            className="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                        >
                                            Log in
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </Dialog.Panel>
                    </Dialog>
                </header>

                <div className="relative isolate px-6 pt-14 lg:px-8">
                    <div
                        className="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                        aria-hidden="true"
                    >
                        <div
                            className="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                            style={{
                                clipPath:
                                    "polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)",
                            }}
                        />
                    </div>
                    <div className="mx-auto max-w-5xl py-32 sm:py-48 lg:py-32">
                        <Card className="">
                            <CardHeader className="flex justify-center items-center">
                                <CardTitle>Projects</CardTitle>
                                <CardDescription>
                                    Activity of all our glorious projects
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <DataTable
                                    enableSearch={false}
                                    columns={columns}
                                    data={projectData}
                                />
                            </CardContent>
                        </Card>
                    </div>

                    <div
                        className="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                        aria-hidden="true"
                    >
                        <div
                            className="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                            style={{
                                clipPath:
                                    "polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)",
                            }}
                        />
                    </div>
                </div>
            </div>
            <div className="bg-muted text-center fixed w-full bottom-0 dark:bg-neutral-700  p-3  text-neutral-700 dark:text-neutral-200">
                © 2023 Copyright FYP Forge
            </div>
        </>
    );
}
