// A debounced input react component
import {InputHTMLAttributes, useEffect, useState} from "react";
import {Input} from "@/Components/ui/input";
import {IconInput} from "@/Components/ui/icon-input";

export default function DebouncedInput({
                                           value: initialValue,
                                           onChange,
                                           debounce = 500,
                                           ...props
                                       }: {
    value: string | number
    onChange: (value: string | number) => void
    debounce?: number
} & Omit<InputHTMLAttributes<HTMLInputElement>, 'onChange'>) {
    const [value, setValue] = useState(initialValue)

    useEffect(() => {
        setValue(initialValue)
    }, [initialValue])

    useEffect(() => {
        const timeout = setTimeout(() => {
            onChange(value)
        }, debounce)

        return () => clearTimeout(timeout)
    }, [value])

    return (
        <IconInput  {...props} value={value} onChange={e => setValue(e.target.value)}/>
    )
}
